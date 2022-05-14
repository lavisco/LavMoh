<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div
                            class="
                                d-flex
                                flex-column
                                justify-content-center
                                align-items-center
                            "
                        >
                            <img v-if="image_path" :src="image_path" width="350px" class="mb-4" />
                            <h1>Coming soon</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        image_path: "",
    }),

    methods: {
        loadData() {
            axios
                .get("/api/seller/dashboard/coming_soon")
                .then(({ data }) => {
                    this.image_path = data.image_path;
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        this.loadData();
    },
};
</script>
