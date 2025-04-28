<form id="payment-success-form" action="{{ route("payment.success") }}" method="POST"
  class="hidden">
  @csrf
  <input value="{{ $transaction_id }}" type="hidden" name="transaction_id" id="transaction_id">
</form>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    snap.pay("{{ $snap_token ?? '' }}", {
      onSuccess: function(result) {
        alert("Pembayaran berhasil!");
        console.log(result);

        // submit form ke route payment-success
        document.getElementById("payment-success-form").submit();
      },
      onPending: function(result) {
        alert("Transaksi pending!");
        console.log(result);
        window.location.href = "/";
      },
      onError: function(result) {
        alert("Pembayaran gagal.");
        console.log(result);
        window.location.href = "/";
      },
      onClose: function() {
        alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
        window.location.href = "/";
      }
    });
  });

</script>