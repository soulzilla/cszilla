<?php

namespace app\commands;

use app\models\GameMatch;
use app\models\Team;
use PHPHtmlParser\Dom;
use yii\console\Controller;

class FeedController extends Controller
{
    private $domain = 'https://www.hltv.org';
    private $matchesUrl = 'https://www.hltv.org/matches';
    private $resultsUrl = 'https://www.hltv.org/results';

    public function actionIndex()
    {
        $dom = new Dom();
        $dom->loadFromUrl($this->matchesUrl);
        $matches = $dom->find('.match');

        $urlsToParse = [];

        foreach ($matches as $match) {
            $matchUrl = $match->getAttribute('href');
            $start_ts = $match->find('.matchTime')->getAttribute('data-unix');
            $urlsToParse[$matchUrl] = $start_ts;
        }

        if (!sizeof($urlsToParse)) {
            return;
        }

        foreach ($urlsToParse as $path => $start_ts) {
            $url = $this->domain . $path;
            $pathArray = explode('/', $path);
            $properMatchId = $pathArray[2];
            $dom->loadFromUrl($url);
            $noTeam = $dom->find('.noteam');
            if ($noTeam->count()) {
                continue;
            }
            $teamIds = $this->checkTeams($dom);
            if (sizeof($teamIds)) {
                $this->createMatch($properMatchId, $url, $teamIds, $start_ts);
            }
        }
    }

    private function checkTeams(Dom $dom)
    {
        $noTeam = $dom->find('.noteam');
        if ($noTeam->count()) {
            return [];
        }

        $teamUrls = [];
        $team1 = $dom->find('.team1-gradient');
        $team2 = $dom->find('.team2-gradient');
        try {
            $teamUrls[] = $team1->firstChild()->getAttribute('href');
            $teamUrls[] = $team2->firstChild()->getAttribute('href');
        } catch (\Exception $exception) {
            return [];
        }

        $ids = [];

        foreach ($teamUrls as $teamPath) {
            $urlArray = explode('/', $teamPath);
            $teamId = $urlArray[2];

            /** @var Team $team */
            if ($team = Team::find()->where(['hltv_id' => $teamId])->one()) {
                $ids[] = $team->id;
                continue;
            }

            $url = $this->domain . $teamPath;

            $dom->loadFromUrl($url);
            $name = $dom->find('.profile-team-name')->innerHtml;
            $logo = $dom->find('.profile-team-logo-container')->firstChild()->getAttribute('src');

            if ($logo == '/img/static/team/placeholder.svg') {
                $logo = '/images/1613398727602a82c7d38584.13918681.png';
            }

            $team = new Team();
            $team->name = $name;
            $team->logo = $logo;
            $team->hltv_id = $teamId;
            $team->hltv_profile = $url;
            $team->save();
            $ids[] = $team->id;
        }

        return $ids;
    }

    private function createMatch($id, $url, $teamIds, $start_ts)
    {
        $match = GameMatch::find()->where(['hltv_id' => $id])->one();
        if ($match) {
            return $match;
        }

        $match = new GameMatch();
        $match->first_team = $teamIds[0];
        $match->second_team = $teamIds[1];
        $match->hltv_id = $id;
        $match->hltv_url = $url;
        $start_ts = substr($start_ts, 0, 10);
        $match->start_ts = date('Y-m-d H:i:s', (int) $start_ts + 3*60*60);
        $match->save();

        return $match;
    }

    public function actionResults()
    {
        $dom = new Dom();
        $dom->loadFromUrl($this->resultsUrl);
        $allResults = $dom->find('.allres');
        $results = $allResults->find('.result-con');

        foreach ($results as $result) {
            $url = $result->firstChild()->getAttribute('href');
            $start_ts = $result->getAttribute('data-zonedgrouping-entry-unix');

            $matchId = explode('/', $url)[2];
            /** @var GameMatch $match */
            $match = GameMatch::find()->where(['hltv_id' => $matchId])->one();

            if (!$match) {
                $url = $this->domain . $url;
                $dom->loadFromUrl($url);
                $teamIds = $this->checkTeams($dom);
                $match = $this->createMatch($matchId, $url, $teamIds, $start_ts);
            }

            $final_score = strip_tags($result->find('.result-score')->innerHtml);
            $scores = explode(' - ', $final_score);
            $match->final_score = $final_score;
            if ($scores[0] > $scores[1]) {
                $match->winner_team = $match->first_team;
            } else {
                $match->winner_team = $match->second_team;
            }
            $match->is_finished = 1;
            $match->save();
        }
    }
}
