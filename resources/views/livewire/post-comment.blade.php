<div class="comments">

    <div class="comment-form">
        <div class="comment-invite">
            Laissez un commentaire ici
            {{ $newComment }}
        </div>
        <form class="w-full">
            <div class="flex flex-col">
                <div>
                    <textarea rows="3" class="w-full" wire:model="newComment"></textarea>
                </div>
                <div>
                    <button class="button-link" wire:click.prevent="addComment"> Poster</button>
                </div>


            </div>
        </form>
        <h2 class="comments-title">Commentaires des adhérents</h2>
        <div>
            @foreach ($comments as $comment)
                <div class="comment-header">
                    Posté par
                    {!! \App\Models\User::find($comment['agent_id'])->firstname !!}
                    {!! \App\Models\User::find($comment['agent_id'])->familyname !!}

                    le
                    <?php \Carbon\Carbon::setLocale('fr'); ?>
                    {{ \Carbon\Carbon::parse($comment['created_at'])->translatedFormat('l jS F Y') }}
                </div>
                @if ($underEdition == $comment['id'])
                    <div class="comment-under-edition">
                        <h2 class="">Commentaire en cours de modification</h2>
                        <textarea rows="3" class="w-full underEdition"
                            wire:model="underEditionComment"> {{ $comment['content'] }}</textarea>
                    </div>
                    <div class=" comment-buttons">
                        <button class="button-link" wire:click.prevent="updateComment({{ $comment['id'] }})">
                            Poster</button>
                    </div>
                @else
                    <div class="comment-body">
                        {{ $comment['content'] }}
                    </div>

                    <div class="flex flex-row comment-buttons">
                        @can('update', \App\Models\Comment::find($comment['id']))
                            <button class="fontawesome-icon" wire:click.prevent="editComment({{ $comment['id'] }})">
                                <span data-toggle="tooltip" title="Modifier" class=" fa fa-edit fa-xs "></span>
                            </button>
                            <button class="fontawesome-icon" wire:click.prevent="deleteComment({{ $comment['id'] }})">
                                <span data-toggle="tooltip" title="Supprimer" class=" fa fa-trash fa-xs "></span>
                            </button>

                            <button
                                wire:click='$emit("openModal", "livewire-modal", {{ json_encode(['type' => 'Le commentaire', 'ident' => $comment['id']]) }})'><span
                                    data-toggle="tooltip" title="Modifier" class=" fa fa-trash fa-xs "></span></button>
                        @endcan
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>