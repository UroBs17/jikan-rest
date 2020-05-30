<?php

class AnimeControllerV4Test extends TestCase
{
    public function testMain()
    {
        $this->get('/v4/anime/1')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'mal_id',
                'url',
                'image_url',
                'trailer' => [
                    'youtube_id',
                    'url',
                    'embed_url',
                    'images' => [
                        'default_image_url',
                        'small_image_url',
                        'medium_image_url',
                        'large_image_url',
                        'maximum_image_url',
                    ]
                ],
                'title',
                'title_english',
                'title_japanese',
                'title_synonyms',
                'type',
                'source',
                'episodes',
                'status',
                'airing',
                'aired' => [
                    'from',
                    'to',
                    'prop' => [
                        'from' => [
                            'day',
                            'month',
                            'year'
                        ],
                        'to' => [
                            'day',
                            'month',
                            'year'
                        ]
                    ],
                    'string'
                ],
                'duration',
                'rating',
                'score',
                'scored_by',
                'rank',
                'popularity',
                'members',
                'favorites',
                'synopsis',
                'background',
                'premiered',
                'broadcast',
                'related' => [
                    [
                        'relation',
                        'items' => [
                            'mal_id',
                            'type',
                            'name',
                            'url'
                        ]
                    ]
                ],
                'producers' => [
                    [
                        'mal_id',
                        'type',
                        'name',
                        'url'
                    ]
                ],
                'licensors' => [
                    [
                        'mal_id',
                        'type',
                        'name',
                        'url'
                    ]
                ],
                'studios' => [
                    [
                        'mal_id',
                        'type',
                        'name',
                        'url'
                    ]
                ],
                'genres' => [
                    [
                        'mal_id',
                        'type',
                        'name',
                        'url'
                    ]
                ],
                'opening_themes',
                'ending_themes'
            ]);
    }

    public function testCharactersStaff()
    {
        $this->get('/v4/anime/1/characters_staff')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'characters' => [
                    [
                        'mal_id',
                        'url',
                        'image_url',
                        'name',
                        'voice_actors' => [
                            [
                                'mal_id',
                                'name',
                                'image_url',
                                'language'
                            ]
                        ]
                    ]
                ],
                'staff' => [
                    [
                        'mal_id',
                        'url',
                        'name',
                        'image_url',
                        'positions'
                    ]
                ],
            ]);
    }

    public function testEpisodes()
    {
        $this->get('/v4/anime/1/episodes')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'last_visible_page',
                'hast_next_page',
                'episodes' => [
                    [
                        'episode_id',
                        'title',
                        'title_japanese',
                        'title_romanji',
                        'aired',
                        'filler',
                        'recap',
                        'video_url',
                        'forum_url'
                    ]
                ]
            ]);

        $this->get('/v4/anime/21/episodes?page=2')
            ->seeStatusCode(200)
            ->seeJson([
                'last_visible_page',
                'hast_next_page',
                'episodes' => [
                    [
                        'episode_id',
                        'title',
                        'title_japanese',
                        'title_romanji',
                        'aired',
                        'filler',
                        'recap',
                        'video_url',
                        'forum_url'
                    ]
                ]
            ])
            ->seeJsonContains([
                'episodes' => [
                    [
                        'mal_id' => 101,
                        'title' => 'Showdown in a Heat Haze! Ace vs. the Gallant Scorpion!'
                    ]
                ]
            ]);;
    }

    public function testEpisode()
    {
        $this->get('/v4/anime/21/episodes/1')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'mal_id',
                'url',
                'title',
                'title_japanese',
                'title_romanji',
                'duration',
                'aired',
                'aired',
                'filler',
                'recap',
                'synopsis'
            ]);
    }

    public function testNews()
    {
        $this->get('/v4/anime/1/news')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'articles' => [
                    [
                        'mal_id',
                        'url',
                        'title',
                        'date',
                        'author_name',
                        'author_url',
                        'forum_url',
                        'image_url',
                        'comments',
                        'excerpt'
                    ]
                ]
            ]);
    }

    public function testPictures()
    {
        $this->get('/v4/anime/1/pictures')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'images' => [
                    [
                        'large_image_url',
                        'small_image_url',
                    ]
                ]
            ]);
    }

    public function testVideos()
    {
        $this->get('/v4/anime/1/videos')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'promos' => [
                    [
                        'title',
                        'image_url',
                        'trailer' => [
                            'youtube_id',
                            'url',
                            'embed_url',
                            'images' => [
                                'default_image_url',
                                'small_image_url',
                                'medium_image_url',
                                'large_image_url',
                                'maximum_image_url',
                            ]
                        ],
                    ]
                ],
                'episodes' => [
                    [
                        'mal_id',
                        'title',
                        'episode',
                        'url',
                        'image_url',
                    ]
                ]
            ]);
    }

    public function testStats()
    {
        $this->get('/v4/anime/21/statistics')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'watching',
                'completed',
                'on_hold',
                'dropped',
                'plan_to_watch',
                'total',
                'scores' => [
                    1 => [
                        'votes',
                        'percentage'
                    ]
                ]
            ]);
    }

    public function testForum()
    {
        $this->get('/v4/anime/1/forum')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'topics' => [
                    [
                        'mal_id',
                        'url',
                        'title',
                        'date',
                        'author_name',
                        'author_url',
                        'replies',
                        'last_comment' => [
                            'url',
                            'author_name',
                            'author_url',
                            'date'
                        ]
                    ]
                ]
            ]);
    }

    public function testMoreInfo()
    {
        $this->get('/v4/anime/1/moreinfo')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'moreinfo'
            ]);
    }

    public function testReviews()
    {
        $this->get('/v4/anime/1/reviews')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'reviews' => [
                    [
                        'mal_id',
                        'url',
                        'helpful_count',
                        'date',
                        'scores' => [
                            'overall',
                            'story',
                            'animation',
                            'sound',
                            'character',
                            'enjoyment'
                        ],
                        'content',
                        'reviewer' => [
                            'url',
                            'image_url',
                            'username',
                            'episodes_seen'
                        ]
                    ]
                ]
            ]);

        $this->get('/v3/anime/1/reviews/100')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'reviews' => []
            ]);
    }

    public function testRecommendations()
    {
        $this->get('/v4/anime/1/recommendations')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'recommendations' => [
                    [
                        'mal_id',
                        'url',
                        'image_url',
                        'recommendation_url',
                        'title',
                        'recommendation_count'
                    ]
                ]
            ]);
    }

    public function testUserUpdates()
    {
        $this->get('/v4/anime/1/userupdates')
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'recommendations' => [
                    [
                        'username',
                        'url',
                        'image_url',
                        'score',
                        'status',
                        'episodes_seen',
                        'episodes_total',
                        'date'
                    ]
                ]
            ]);

        $this->get('/v4/anime/1/userupdates/1000')
            ->seeStatusCode(404);
    }

    public function test404()
    {
        $this->get('/v4/anime/2')
            ->seeStatusCode(404);
    }
}
