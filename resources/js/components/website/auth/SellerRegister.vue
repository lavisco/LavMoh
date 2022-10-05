<template>
    <!-- Body -->
    <div class="container-fluid login">
        <h1>Seller Sign Up</h1>
        <h5>Get started Today! Grow your business with us.</h5>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="createSellerUser()">
                <div class="row">
                    <div class="col-6 form-group pr-2">
                        <label class="col-form-label" for="first_name">
                            First Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="first_name"
                            v-model="form.first_name"
                            type="text"
                            name="first_name"
                            class="form-control"
                            placeholder="First Name"
                        />
                        <HasError :form="form" field="name" />
                    </div>
                    <div class="col-6 form-group pl-2">
                        <label class="col-form-label" for="last_name">
                            Last Name
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input
                            id="last_name"
                            v-model="form.last_name"
                            type="text"
                            name="last_name"
                            class="form-control"
                            placeholder="Last Name"
                        />
                        <HasError :form="form" field="name" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="email">
                        Email
                        <strong class="text-danger"> * </strong>
                    </label>
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
                <div class="form-group">
                    <label class="col-form-label" for="phone">
                        Phone
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="phone-code"
                        v-model="form.phone"
                        type="text"
                        name="phone"
                        class="form-control"
                    />

                    <HasError :form="form" field="phone" />
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="password">
                        Password
                        <strong class="text-danger"> * </strong>
                    </label>
                    <div class="password-input">
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                        />
                        <i
                            class="fas fa-eye"
                            onclick="showPasswordFunction()"
                        ></i>
                    </div>

                    <HasError :form="form" field="password" />
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="password_confirmation">
                        Confirm Password
                        <strong class="text-danger"> * </strong>
                    </label>
                    <div class="password-input">
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm Password"
                        />
                        <i
                            class="fas fa-check pwd-confirm"
                            v-show="
                                form.password &&
                                form.password == form.password_confirmation
                            "
                        ></i>
                    </div>
                    <HasError :form="form" field="password_confirmation" />
                </div>

                <div class="d-flex justify-content-center my-5">
                    <button
                        type="submit"
                        class="btn-full"
                        :disabled="submitButtonDisabled"
                    >
                        {{ submitButtonText }}
                    </button>
                </div>
            </form>
            <!-- Form end -->
        </div>

        <!-- Notification Modal -->
        <success-modal
            id="success-modal"
            msgTitle="Successfully Registered"
            msg="You are now a Lavisco Seller! You'll be redirected to your dashboard."
            gotoRoute="seller-dashboard"
        />
        <fail-modal
            id="fail-modal"
            msgTitle="Seller Registration Failed"
            msg="There are errors in your form input. Please double check."
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
        submitButtonText: "Sign Up",
        submitButtonDisabled: false,
        form: new Form({
            id: "",
            first_name: "",
            last_name: "",
            name: "",
            email: "",
            phone: "",
            dial_code: "",
            password: "",
            password_confirmation: "",
        }),
    }),

    methods: {
        createSellerUser() {
            this.form.name = `${this.form.first_name} ${this.form.last_name}`;

            //.iti__selected-dial-code is the class name of the div that contains the dial code
            this.form.dial_code = document.querySelector(
                ".iti__selected-dial-code"
            ).innerHTML;

            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;

            this.form
                .post("/api/seller/user")
                .then(() => {
                    this.submitButtonText = "Submitted";
                    this.submitButtonDisabled = false;
                    //this.sendSellerWelcomeMail(this.form.email);
                })
                .then(() => {
                    this.form
                        .post("/seller-login")
                        .then(() => {
                            $("#success-modal").modal("show");
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                })
                .catch((error) => {
                    this.submitButtonText = "Submit";
                    this.submitButtonDisabled = false;
                    console.log(error);
                    $("#fail-modal").modal("show");
                });
        },

        sendSellerWelcomeMail(email) {
            axios
                .get("/api/email/seller_welcome/" + email)
                .then(() => {})
                .catch((error) => {
                    console.log(error);
                });
        },

        initPhoneDialCode() {
            var input = document.querySelector("#phone-code");
            window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: "lk",
            });

            /*
            the cdn & stylesheet for this function is placed in layouts > master.blade.php containing https://cdn.tutorialjinni.com
            .iti__selected-dial-code is the class name of the div that contains the dial code
            */
        },
    },

    mounted() {
        this.initPhoneDialCode();
    },
};
</script>
