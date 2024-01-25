<html>
  <body>
    <h1>FoodGuard</h1>
    <button id="rzp-button1">Pay</button>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
      var options = {
        key: "rzp_test_DlM6Folvp8cvz8", // Enter the Key ID generated from the Dashboard
        amount: "1000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        currency: "MYR",
        name: "FoodGuard", //your business name
        description: "Make your payment",
        image: "https://example.com/your_logo",
        order_id: "order_NPEMVNeQedLbdS", //This is a sample Order ID. Pass the id obtained in the response of Step 1
        handler: function (response) {
          alert(response.razorpay_payment_id);
          alert(response.razorpay_order_id);
          alert(response.razorpay_signature);
        },
        prefill: {
          //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
          name: "Nasrul Amin", //your customer's name
          email: "nasamin@gmail.com",
          contact: "0108779859", //Provide the customer's phone number for better conversion rates
        },
        notes: {
          address: "Razorpay Corporate Office",
        },
        theme: {
          color: "#3399cc",
        },
      };
      var rzp1 = new Razorpay(options);
      rzp1.on("payment.failed", function (response) {
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
      });
      document.getElementById("rzp-button1").onclick = function (e) {
        rzp1.open();
        e.preventDefault();
      };
    </script>
  </body>
</html>