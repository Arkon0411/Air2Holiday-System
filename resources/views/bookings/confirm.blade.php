<x-layouts.app.header>
  <div class="container mx-auto p-6">
    <flux:heading>Booking Confirmation</flux:heading>

    <div class="mt-6 p-4 bg-white rounded">
      <div class="text-sm">Booking #{{ $booking->id }}</div>
      <div class="font-semibold">Flight: {{ optional($booking->flight)->flight_number }}</div>
      <div class="text-sm">Seat: {{ $booking->seat_number }}</div>
      <div class="text-sm">Status: {{ ucfirst($booking->status) }}</div>

      @if($booking->payment)
        <div class="mt-4">
          <form method="POST" action="{{ route('payments.pay', ['payment' => $booking->payment->id]) }}">
            @csrf
            <button class="px-3 py-1 bg-accent text-white rounded">Mark Payment Paid (stub)</button>
          </form>
        </div>
      @endif
    </div>
  </div>
</x-layouts.app.header>
