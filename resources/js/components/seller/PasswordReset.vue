<template>
    <div>
        <!-- Body -->
        <div class="container mt-3 mb-5">
            <div class="row">
                <div class="col">
                    <div class="container">
                        <div class="card">
                            <!-- Form start -->
                            <form
                                class="input-form"
                                @submit.prevent="updateUserPassword()"
                            >
                                <div class="input-form-compact">
                                    <h4 class="mb-4">Password Reset</h4>

                                    <div class="form-group row">
                                        <label
                                            class="col-md-3 col-form-label"
                                            for="password"
                                            >Password
                                            <strong class="text-danger">
                                                *</strong
                                            >
                                        </label>

                                        <div class="col-md-9">
                                            <input
                                                id="password"
                                                v-model="form.password"
                                                type="password"
                                                name="password"
                                                class="form-control"
                                            />
                                            <HasError
                                                :form="form"
                                                field="password"
                                            />
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
                                        class="btn btn-secondary mr-3"
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
                                        Update Password
                                    </button>
                                </div>
                            </form>
                            <!-- Form end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Toast -->
        <success-toast
            id="success-toast"
            msg="Your password has been updated"
            style="margin-bottom: 30px"
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
                    $("#success-toast").toast("show");
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {},
};
</script>
