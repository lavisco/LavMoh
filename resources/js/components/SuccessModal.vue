<template>
    <div
        class="modal fade"
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
                <div class="modal-body">
                    {{ msg }}
                </div>
                <div class="modal-footer">
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
            if (this.gotoRoute != "login") {
                this.$router.push(this.gotoRoute);
            } else {
                window.location.replace("/login");
            }
        },
    },
    mounted() {},
};
</script>
