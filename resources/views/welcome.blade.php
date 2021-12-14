<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <livewire:styles />
</head>
<body style="background:#f4f4f4">
    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <livewire:things />
            </div>
        </div>
        <div class="row" x-data>
            <div class="col">
                <p x-text="$store.app.text"></p>
                <p x-show="$store.app.progress">Progress ...</p>
            </div>
        </div>
    </div>
    <livewire:scripts />
    <script>
        let root = document.querySelector('[drag-root]')
        root.querySelectorAll('[drag-item]').forEach(element => {
            element.addEventListener('dragstart', event => {
                event.target.setAttribute('drag', true)
                // console.log('start')
            })
            element.addEventListener('drop', event => {
                event.target.classList.remove('bg-warning', 'bg-opacity-25')
                let drag = root.querySelector('[drag]');
                if (drag.getAttribute('wire:key') > event.target.getAttribute('wire:key')) {
                    event.target.before(drag)
                } else {
                    event.target.after(drag)
                }
                // console.log('drop')
                let component = Livewire.find(
                    event.target.closest('[wire\\:id]').getAttribute('wire:id')
                )
                console.log(root.querySelectorAll('[drag-item]'))
                let keys = Array.from(root.querySelectorAll('[drag-item]')).map(item => item.getAttribute('drag-item'))
                console.log(keys)
                let method = root.getAttribute('drag-root')
                component.call(method, keys)
            })
            element.addEventListener('dragenter', event => {
                event.target.classList.add('bg-warning', 'bg-opacity-25')
                // console.log('enter')
                event.preventDefault()
            })
            element.addEventListener('dragover', event => {
                // console.log('over')
                event.preventDefault()
            })
            element.addEventListener('dragleave', event => {
                event.target.classList.remove('bg-warning', 'bg-opacity-25')
                // console.log('leave')
            })
            element.addEventListener('dragend', event => {
                event.target.removeAttribute('drag');
                // console.log('end')
            })
        })
        document.addEventListener('alpine:init', () => {
            console.log('alpine:init')
            Alpine.store('app', {
                text: 'Hallo ...',
                progress: false,
                toggle() {
                    console.log('toggle')
                    this.progress = !this.progress
                }
            })
        })
    </script>
</body>
</html>
