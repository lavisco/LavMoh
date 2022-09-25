<template>
    <!-- Body -->
    <div class="container-fluid login">
        <h1>Sign Up</h1>
        <h5>To unlock exclusive drops and discounts!</h5>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="createUser()">
                <div class="row">
                    <div class="col-6 form-group">
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
                    <div class="col-6 form-group">
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
                    <div class="input-form input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light-grey">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true"
                                    role="img"
                                    width="30px"
                                    height="30px"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 72 72"
                                >
                                    <path fill="#d22f27" d="M5 17h62v38H5z" />
                                    <path fill="#5c9e31" d="M5 17h11v38H5z" />
                                    <path fill="#e27022" d="M16 17h10v38H16z" />
                                    <path
                                        fill="none"
                                        stroke="#f1b31c"
                                        stroke-miterlimit="10"
                                        stroke-width="2"
                                        d="M26 18v36M7 19h58v34H7z"
                                    />
                                    <path
                                        fill="none"
                                        stroke="#f1b31c"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M50 45h2l1-2l-3-6m-9 8h2l1-2l-3-6m-4-11a7.07 7.07 0 0 0-1 4v12"
                                    />
                                    <path
                                        fill="#f1b31c"
                                        stroke="#f1b31c"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M44 41c3 0 3-2 7-2l5 2c-1-2 2-3 1-6H42s-3 2-3 5h3Z"
                                    />
                                    <path
                                        fill="none"
                                        stroke="#f1b31c"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M54 45h2l1-2l-3-6m-19 0l4 3m17-9a2 2 0 0 1 0 4m-4-4a2 2 0 0 1 0-4"
                                    />
                                    <rect
                                        width="4"
                                        height="5"
                                        x="42"
                                        y="30"
                                        fill="#f1b31c"
                                        rx="1"
                                        ry="1"
                                    />
                                    <rect
                                        width="4"
                                        height="5"
                                        x="42"
                                        y="30"
                                        fill="none"
                                        stroke="#f1b31c"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        rx="1"
                                        ry="1"
                                    />
                                    <path
                                        fill="none"
                                        stroke="#f1b31c"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M52 31h4m4-7l1-1m-30 1l-1-1m13 9l-3-1m3 2l-3 1m20 14l1 1m-30-1l-1 1"
                                    />
                                    <path
                                        fill="none"
                                        stroke="#fff"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 17h62v38H5z"
                                    />
                                </svg>
                                +94
                            </span>
                        </div>
                        <input
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            name="phone"
                            class="form-control"
                            placeholder="Phone"
                        />
                    </div>
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
            msg="You are now a Lavisco Seller! You'll be redirected to the login page."
            gotoRoute="login"
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
            password: "",
            password_confirmation: "",
        }),
    }),

    methods: {
        createUser() {
            this.form.name = `${this.form.first_name} ${this.form.last_name}`;
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;
            this.form
                .post("/register")
                .then(() => {
                    this.submitButtonText = "Submitted";
                    this.submitButtonDisabled = false;
                    $("#success-modal").modal("show");
                })
                .catch((error) => {
                    this.submitButtonText = "Submit";
                    this.submitButtonDisabled = false;
                    console.log(error);
                });
        },
    },

    mounted() {},
};
</script>
