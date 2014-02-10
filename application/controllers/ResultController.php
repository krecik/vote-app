<?php

class ResultController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $query = \Model\VoteQuery::create()->keepQuery();
        $allVotes = $query->count();
        $votesGoing = $query->filterByIsGoingVote(1)->count();
        $this->view->allVotes = $allVotes;
        $this->view->votesGoing = $votesGoing;

        $constuencies = \Model\ConstituencyQuery::create()
            ->leftJoinVote()
            ->withColumn('(SELECT COUNT(*) FROM vote WHERE is_going_vote = 0 AND id_constituency = '. \Model\ConstituencyPeer::ID .')', 'NotGoing')
            ->find();

        $this->view->constuencies = $constuencies;
    }


    public function seeVotesAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');

        if (empty($id)) {
            throw new Exception('Constituency ID not set!');
        }
        $constituency = \Model\ConstituencyQuery::create()->findOneById($id);
        if(!$constituency) {
            throw new Exception('Constituency doesn\'t exists!');

        }
        $query = \Model\VoteQuery::create()->filterByConstituency($constituency)->keepQuery();
        $allVotes = $query->count();
        $votesGoing = $query->filterByIsGoingVote(1)->count();
        $this->view->allVotes = $allVotes;
        $this->view->votesGoing = $votesGoing;

        $votes = \Model\VoteQuery::create()
            ->filterByConstituency($constituency)
            ->find();

        $this->view->votes = $votes;
        $this->view->constituency = $constituency;

    }
}

