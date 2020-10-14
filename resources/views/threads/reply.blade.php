<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
      <div class="card-content">
        <div class="media">
          <div class="media-left">
            <figure class="image is-48x48">
              <img src="https://picsum.photos/48/48?r={{ rand(0, 10) }}" alt="Placeholder image">
            </figure>
          </div>
          <div class="media-content">
            <p class="title is-6">
                <a href="{{ route('profiles.show', ['profile' => $reply->owner->name]) }}">
                    <sometag v-pre>@</sometag>{{ $reply->owner->name }}
                </a>
            </p>
            <p class="subtitle is-6">
                <small>{{ $reply->created_at->diffForHumans() }}</small>
            </p>
          </div>
          <div class="media-right">
              <favorite :reply="{{ $reply }}"></favorite>
              @can('delete', $reply)
                  <button @click="destroy" type="submit" class="button is-text is-small" name="button">Delete</button>
              @endcan
              @can('update', $reply)
                  <button @click="editing = true" type="submit" class="button is-text is-small" name="button">Edit</button>
              @endcan
          </div>
        </div>
        <div class="content">
            <div v-if="editing">
                <textarea v-model="body" class="textarea" name="name" rows="3"></textarea>
            </div>
            <p v-else v-text="body"></p>
            <div v-if="editing" class="mt-1">
                <div class="buttons">
                    <button @click="editing = false" type="button" class="button is-small" name="button">Cancel</button>
                    <button @click="update" type="button" class="button is-small" name="button">Update</button>
                </div>
            </div>
        </div>
      </div>
    </div>
</reply>
