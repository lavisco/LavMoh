<template>
    <div></div>
</template>

<script>
export default {
    props: ["orderId", "orderEmail", "orderRecipientemail"],
    data: () => ({}),

    methods: {
        sendBuyerOrderMail() {
            axios
                .get("/api/email/buyer_order_new/" + this.orderId)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
        sendBuyerRecipientOrderMail() {
            if (this.orderEmail != this.orderRecipientemail) {
                axios
                    .get("/api/email/buyer_recipient_order_new/" + this.orderId)
                    .then(() => {})
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        sendSellerOrderMail() {
            axios
                .get("/api/email/seller_order_new/" + this.orderId)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {
        this.sendBuyerOrderMail();
        this.sendSellerOrderMail();
        this.sendBuyerRecipientOrderMail();
    },
};
</script>
