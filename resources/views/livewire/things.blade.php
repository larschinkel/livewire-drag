<div>
    <ul drag-root="reorder" class="list-group">
        @foreach ($things as $thing)
            <li drag-item="{{ $thing['id'] }}" draggable="true" wire:key="{{ $thing['id'] }}" class="list-group-item">
                {{ $thing['title'] }}
            </li>
        @endforeach
    </ul>
    <button wire:click="$refresh">Refresh</button>
    <button x-data @click="$store.app.toggle()">Toggle</button>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => { 
                console.log('message.processed')
                Alpine.store('app').toggle()
            })
        });
    </script>

</div>
