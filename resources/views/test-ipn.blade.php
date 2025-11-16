<form action="/deposit/ipn" method="POST">
    @csrf
    <input name="invoice_id" value="6307771452" />
    <input name="payment_status" value="confirmed" />
    <button type="submit">Send IPN</button>
</form>
