<template>
    <div
        class="modal fade notif-modal"
        id="fail-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="failModalTitle"
        aria-hidden="true"
        data-backdrop="static"
        data-keyboard="false"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="mb-0" id="failModalTitle">
                        {{ msgTitle }}
                    </h4>
                    <button
                        type="button"
                        class="close"
                        aria-label="Close"
                        @click.prevent="closeModal()"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true"
                        role="img"
                        width="80"
                        height="80"
                        preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 36 36"
                        class="mb-4"
                    >
                        <circle
                            cx="18"
                            cy="26.06"
                            r="1.33"
                            fill="#e3342f"
                            class="clr-i-outline clr-i-outline-path-1"
                        />
                        <path
                            fill="#e3342f"
                            d="M18 22.61a1 1 0 0 1-1-1v-12a1 1 0 1 1 2 0v12a1 1 0 0 1-1 1Z"
                            class="clr-i-outline clr-i-outline-path-2"
                        />
                        <path
                            fill="#e3342f"
                            d="M15.062 1.681a3.221 3.221 0 0 1 5.647.002l13.89 25.56A3.22 3.22 0 0 1 31.77 32H4.022a3.22 3.22 0 0 1-2.9-4.759l13.94-25.56ZM2.88 28.198A1.22 1.22 0 0 0 4 30h27.77a1.22 1.22 0 0 0 1.071-1.803L18.954 2.642a1.22 1.22 0 0 0-2.137-.001L2.879 28.198Z"
                            class="clr-i-outline clr-i-outline-path-3"
                        />
                        <path fill="none" d="M0 0h36v36H0z" />
                    </svg>
                    <h5>
                        {{ msg }}
                    </h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button
                        type="button"
                        class="btn bg-danger"
                        @click.prevent="closeModal()"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["msg", "msgTitle"],
    methods: {
        closeModal() {
            $("#fail-modal").modal("hide");
        },
    },
    mounted() {},
};
</script>
