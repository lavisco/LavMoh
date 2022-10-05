<template>
    <!-- Body -->
    <div class="container-fluid login">
        <h1>Password Reset Email</h1>
        <h5>Provide your email to send the password reset link</h5>

        <div
            class="alert"
            :class="{
                'alert-success': success === true,
                'alert-info': success === false,
            }"
            v-if="success != null"
        >
            {{ msg }}
        </div>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="sendPwdResetLInk()">
                <div class="form-group">
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                    />
                    <HasError :form="form" field="email" />
                </div>

                <div class="d-flex justify-content-center mt-3 mb-5">
                    <button type="submit" class="btn-full">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
            <!-- Form end -->
        </div>
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
        success: null,
        msg: "",
        form: new Form({
            id: "",
            email: "",
        }),
    }),

    methods: {
        sendPwdResetLInk() {
            this.form
                .post("/password/email")
                .then(() => {
                    this.success = true;
                    this.msg =
                        "Please check your email inbox for the password reset link";
                })
                .catch((error) => {
                    console.log(error);
                    this.success = false;
                    this.msg = "There has been an error in sending your email";
                });
        },
    },

    mounted() {},
};
</script>
