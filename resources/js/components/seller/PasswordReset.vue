<template>
    <div>
        <!-- Body -->
        <div class="container mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Form start -->
                        <form
                            class="input-form"
                            @submit.prevent="updateUserPassword()"
                        >
                            <div class="input-form-compact">
                                <div class="card dashboard-info-card">
                                    <h4 class="mb-3">Password Reset</h4>
                                    <hr class="mt-0" />
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="old_password"
                                            >Current Password
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>

                                        <div class="col-md-9">
                                            <div class="password-input">
                                                <input
                                                    id="old_password"
                                                    v-model="form.old_password"
                                                    type="password"
                                                    name="old_password"
                                                    class="form-control"
                                                />
                                                <i
                                                    class="fas fa-eye"
                                                    onclick="showOldPasswordFunction()"
                                                ></i>
                                            </div>
                                            <HasError
                                                :form="form"
                                                field="old_password"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="password"
                                            >New Password
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>

                                        <div class="col-md-9">
                                            <div class="password-input">
                                                <input
                                                    id="password"
                                                    v-model="form.password"
                                                    type="password"
                                                    name="password"
                                                    class="form-control"
                                                />
                                                <i
                                                    class="fas fa-eye"
                                                    onclick="showPasswordFunction()"
                                                ></i>
                                            </div>
                                            <HasError
                                                :form="form"
                                                field="password"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="password_confirmation"
                                            >Confirm Password
                                            <strong class="text-danger">
                                                *
                                            </strong>
                                        </label>

                                        <div class="col-md-9">
                                            <div class="password-input">
                                                <input
                                                    id="password_confirmation"
                                                    v-model="
                                                        form.password_confirmation
                                                    "
                                                    type="password"
                                                    name="password_confirmation"
                                                    class="form-control"
                                                />
                                                <i
                                                    class="
                                                        fas
                                                        fa-check
                                                        pwd-confirm
                                                    "
                                                    v-show="
                                                        form.password &&
                                                        form.password ==
                                                            form.password_confirmation
                                                    "
                                                ></i>
                                            </div>

                                            <HasError
                                                :form="form"
                                                field="password_confirmation"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="
                                    d-flex
                                    justify-content-center
                                    align-items-center
                                    mt-4
                                "
                            >
                                <button
                                    type="button"
                                    class="btn btn-grey mr-2 mr-md-3"
                                    @click.prevent="cancel()"
                                >
                                    <i
                                        class="fas fa-times mr-2"
                                        aria-hidden="true"
                                    ></i>
                                    Cancel
                                </button>
                                <button type="submit" class="btn">
                                    <i
                                        class="fas fa-pen-nib mr-2"
                                        aria-hidden="true"
                                    ></i>
                                    Update
                                </button>
                            </div>
                        </form>
                        <!-- Form end -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Modal -->
        <success-modal
            id="success-modal"
            msgTitle="Password Reset Successful"
            msg="Password has been changed."
            gotoRoute="noroute"
        />
        <fail-modal
            id="fail-modal"
            msgTitle="Password Reset Fail"
            msg="There are errors in your form input. Please check again."
        />
    </div>
</template>

<script>
import Form from "vform";
import { HasError, AlertError } from "vform/src/components/bootstrap4";

export default {
    components: {
        HasError,
        AlertError,
    },

    data: () => ({
        user: {},
        form: new Form({
            name: "",
            password: "",
            old_password: "",
            password_confirmation: "",
        }),
    }),

    methods: {
        cancel() {
            this.$router.push("/seller/dashboard");
        },

        updateUserPassword() {
            this.form
                .post("/api/seller/user/password_reset")
                .then(() => {
                    $("#success-modal").modal("show");
                    //this.sendProductListingConfirmedMail();
                })
                .catch((error) => {
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },

        sendProductListingConfirmedMail() {
            axios
                .get("/api/email/password_reset")
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {},
};
</script>
