@component('profiles.activities.activity')
    @slot('heading')
        {{ $profile->name }} published a
        <a class="link" href="{{ $activity->subject->path() }}">
            {{ $activity->subject->title }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
