<template>
    <div class="container-fluid login">
        <h1>Contact us</h1>
        <h5>
            Get in touch with us. Lets us hear your queries and suggestions.
        </h5>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <!-- Form start -->
                    <form class="input-form" @submit.prevent="sendContactMsg()">
                        <div class="form-group">
                            <label class="col-form-label" for="name">
                                Name
                                <strong class="text-danger"> * </strong>
                            </label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Name"
                            />
                            <HasError :form="form" field="name" />
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
                            </label>
                            <input
                                id="phone"
                                v-model="form.phone"
                                type="text"
                                name="phone"
                                class="form-control"
                                placeholder="phone"
                            />
                            <HasError :form="form" field="phone" />
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="msg_body">
                                Message
                                <strong class="text-danger"> * </strong>
                            </label>
                            <textarea
                                id="msg_body"
                                v-model="form.msg_body"
                                type="text"
                                name="msg_body"
                                class="form-control"
                            >
                            </textarea>
                            <HasError :form="form" field="msg_body" />
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
            </div>
            <div class="col-md-6 py-5">
                <div class="card bg-light-grey p-4">
                    <h6>Phone</h6>
                    <h4 class="text-left">+94 777 00 9826</h4>
                    <h6>Email</h6>
                    <h4 class="text-left">hi@lavisco.lk</h4>
                    <h6>Address</h6>
                    <h4 class="text-left">
                        71, Kurunegala Road, Katugastota, Kandy, Sri Lanka 20800
                    </h4>
                </div>
            </div>
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
        submitButtonText: "Send",
        submitButtonDisabled: false,
        form: new Form({
            id: "",
            name: "",
            email: "",
            phone: "",
            msg_body: "",
        }),
    }),

    methods: {
        sendContactMsg() {
            this.submitButtonText = "In Progress...";
            this.submitButtonDisabled = true;
            this.form
                .post("/api/contact")
                .then(() => {
                    this.submitButtonText = "Message Sent";
                    this.submitButtonDisabled = false;
                })
                .catch((error) => {
                    this.submitButtonText = "Send";
                    this.submitButtonDisabled = false;
                    console.log(error);
                });
        },
    },

    mounted() {},
};
</script>
