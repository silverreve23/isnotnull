<x-app-layout>
    <section class="section">
        <div class="container">
            <p class="title">{{ $profile->name }}</p>
            <p class="subtitle">since {{ $profile->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <section class="section">
        <div class="container">
            @forelse($activities as $date => $activity)
                <p class="title is-4">{{ $date }}</p>
                @foreach($activity as $record)
                    @if(view()->exists("profiles.activities.{$record->type}"))
                        @include("profiles.activities.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            @empty
                <p>There are no activities yet.</p>
            @endforelse
        </div>
    </section>
</x-app-layout>
