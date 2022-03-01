<template>
    <div
        class="modal fade notif-modal"
        id="success-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="successModalTitle"
        aria-hidden="true"
        data-backdrop="static"
        data-keyboard="false"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <h4 class="white mb-0" id="successModalTitle">
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
                        <path
                            fill="#1bc894"
                            d="M18 2a16 16 0 1 0 16 16A16 16 0 0 0 18 2Zm0 30a14 14 0 1 1 14-14a14 14 0 0 1-14 14Z"
                            class="clr-i-outline clr-i-outline-path-1"
                        />
                        <path
                            fill="#1bc894"
                            d="M28 12.1a1 1 0 0 0-1.41 0l-11.1 11.05l-6-6A1 1 0 0 0 8 18.53L15.49 26L28 13.52a1 1 0 0 0 0-1.42Z"
                            class="clr-i-outline clr-i-outline-path-2"
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
                        class="btn"
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
    props: ["msg", "msgTitle", "gotoRoute"],
    methods: {
        closeModal() {
            $("#success-modal").modal("hide");
            if (this.gotoRoute != "noroute") {
                if (this.gotoRoute != "login") {
                    this.$router.push(this.gotoRoute);
                } else {
                    window.location.replace("/login");
                }
            }
        },
    },
    mounted() {},
};
</script>
