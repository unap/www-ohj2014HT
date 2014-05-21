<?php

class FeedController extends BaseController {

  /**
   * Make feed
   *
   */
  public function makeFeed()
  {
    $posts = Post::orderBy('created_at', 'desc')->take(20)->get();

    $feed = Feed::make();

    $feed->title ="Images lol";
    $feed->description = 'Page rss-feed';
    $feed->logo = 'http://laravel.com/assets/img/logo-head.png';
    $feed->link = URL::to('feed');
    $feed->pubdate = $posts[0]->created_at;
    $feed->lang = 'en';

    foreach ($posts as $post)
    {
      // set item's title, author, url, pubdate, description and content
      $user = Sentry::findUserById($post->user_id);
      $feed->add($post->title, $user->first_name, url('image', array($post->id)), $post->created_at, $post->description, $post->path);
    }

    return $feed->render('rss');
  }

}