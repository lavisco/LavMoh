<template>
    <!-- Body -->
    <div class="container-fluid login">
        <h1>Shopper Sign In</h1>
        <h5>Welcome back</h5>

        <p>
            Don't have an account?
            <router-link to="/register" class="pink">
                Register today
            </router-link>
        </p>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="loginUser()">
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

                <div class="form-group">
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
                            @click.prevent="showPassword()"
                        ></i>
                    </div>
                    <HasError :form="form" field="password" />
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        />

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                    <router-link to="/reset_password">
                        Forgot Password?
                    </router-link>
                </div>

                <div class="d-flex justify-content-center mt-3 mb-5">
                    <button type="submit" class="btn-full">Sign in</button>
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
        form: new Form({
            id: "",
            email: "",
            password: "",
        }),
    }),

    methods: {
        showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        },

        loginUser() {
            this.form
                .post("/buyer-login")
                .then(() => {
                    window.location.replace("/buyer/dashboard");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    mounted() {},
};
</script>
