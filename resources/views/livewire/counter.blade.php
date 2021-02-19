<div style="text-align: center;">
  {{-- <button wire:click="increment">+</button> --}}
  <input wire:model="count" type="text" placeholder="Increment">
  <h1>{{ $count }}</h1>
</div>
