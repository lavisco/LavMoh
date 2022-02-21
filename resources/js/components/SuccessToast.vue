<template>
    <div
        id="success-toast"
        class="toast"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        data-delay="5000"
        style="position: absolute; bottom: 0; right: 30px; z-index: 1001"
    >
        <div class="toast-header">
            <svg
                class="rounded mr-2"
                width="20"
                height="20"
                xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice"
                focusable="false"
                role="img"
            >
                <rect fill="#1bc894" width="100%" height="100%" />
            </svg>
            <strong class="mr-auto green">Update Successful</strong>
            <button
                type="button"
                class="ml-2 mb-1 close"
                aria-label="Close"
                @click.prevent="closeToast('#success-toast')"
            >
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{ msg }}</div>
    </div>
</template>

<script>
export default {
    props: ["msg"],
    methods: {
        closeToast(toastname) {
            $(toastname).toast("hide");
        },
    },
    mounted() {},
};
</script>
