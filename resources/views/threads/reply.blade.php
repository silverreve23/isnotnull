<article class="media replies">
  <div class="media-content">
    <div class="content">
      <p>
        <strong>{{ $reply->owner->name }}</strong>
        <small>sad</small>
        <small>{{ $reply->created_at->diffForHumans() }}</small>
        <br>
        {{ $reply->body }}
      </p>
    </div>
    <nav class="level is-mobile">
      <div class="level-left">
        <a class="level-item">
          <span class="icon is-small"><i class="fas fa-reply"></i></span>
        </a>
        <a class="level-item">
          <span class="icon is-small"><i class="fas fa-retweet"></i></span>
        </a>
        <a class="level-item">
          <span class="icon is-small"><i class="fas fa-heart"></i></span>
        </a>
      </div>
    </nav>
  </div>
  <div class="media-right">
    <button class="delete"></button>
  </div>
</article>
