<?php

namespace application\tests;

use application\custom\App;
use application\custom\Test;

class DbTest extends Test
{
    public function test_select()
    {
        $this->initAsserts();

        $data = App::db()
            ->get('articles');
        $this->assert('get', count($data) == 50);

        $data = App::db()
            ->where('id', 5)
            ->get('articles');
        $this->assert('where, get', ($data['title'] == 'Статья 5') ? true : false);

        $data = App::db()
            ->where('id >=', 48)
            ->count('articles');
        $this->assert('where >=, count', ($data == 3) ? true : false);

        $data = App::db()
            ->where('id >', 9)
            ->andWhere('id <', 41)
            ->count('articles');
        $this->assert('andWhere', ($data == 31) ? true : false);

        $data = App::db()
            ->where('id <=', 3)
            ->orWhere('title', 'Статья 5')
            ->count('articles');
        $this->assert('orWhere', ($data == 4) ? true : false);

        $data = App::db()
            ->whereIn('id', [1, 2, 3])
            ->count('articles');
        $this->assert('whereIn', ($data == 3) ? true : false);

        $data = App::db()
            ->whereNotIn('id', [1, 2, 3])
            ->count('articles');
        $this->assert('whereNotIn', ($data == 47) ? true : false);



        return $this->assertsResults();
    }
}