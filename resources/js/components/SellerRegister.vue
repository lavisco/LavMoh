<template>
    <!-- Body -->
    <div class="container-fluid login">
        <h1>Seller Sign Up</h1>
        <h5>To start selling your wares today!</h5>

        <div class="card">
            <!-- Form start -->
            <form class="input-form" @submit.prevent="createSellerUser()">
                <div class="form-group">
                    <label class="col-form-label" for="name"
                        >Name
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        name="name"
                        class="form-control"
                        required
                        placeholder="Name"
                    />
                    <HasError :form="form" field="name" />
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="email"
                        >Email
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        name="email"
                        class="form-control"
                        required
                        placeholder="Email"
                    />
                    <HasError :form="form" field="email" />
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="password"
                        >Password
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                    />
                    <HasError :form="form" field="password" />
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="password"
                        >Confirm Password
                        <strong class="text-danger"> * </strong>
                    </label>
                    <input
                        id="password-confirm"
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm Password"
                        required
                    />
                </div>

                <div class="d-flex justify-content-center my-5">
                    <button type="submit" class="btn-full">Sign up</button>
                </div>
            </form>
            <!-- Form end -->
        </div>

        <!-- Notification Modal -->
        <success-modal
            id="success-modal"
            msgTitle="Seller Registration Successful"
            msg="You have successfully been registered. Please Sign In to complete the rest of the steps."
            gotoRoute="login"
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
        form: new Form({
            id: "",
            name: "",
            email: "",
            password: "",
        }),
    }),

    methods: {
        createSellerUser() {
            this.form
                .post("/api/seller/user")
                .then(() => {
                    $("#success-modal").modal("show");
                })
                .catch((error) => {
                    console.log(error);
                    $("#fail-modal").toast("show");
                });
        },
    },

    mounted() {},
};
</script>
