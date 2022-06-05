<template>
    <div
        id="fail-toast"
        class="toast"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        data-delay="4000"
        style="position: absolute; bottom: 0; right: 30px"
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
                <rect fill="#e3342f" width="100%" height="100%" />
            </svg>
            <strong class="mr-auto text-danger">Update Failed</strong>
        </div>
        <div class="toast-body">{{ msg }}</div>
    </div>
</template>

<script>
export default {
    props: ["msg"],
    mounted() {},
};
</script>
