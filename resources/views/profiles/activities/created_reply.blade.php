@component('profiles.activities.activity')
    @slot('heading')
        {{ $profile->name }} replied to
        <a class="link" href="{{ $activity->subject->thread->path() }}">
            {{ $activity->subject->thread->title }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
