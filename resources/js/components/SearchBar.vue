<template>
    <div class="input-group home-search-input order-2">
        <input
            class="form-control"
            placeholder="Search for anything"
            type="text"
            v-model="searchText"
            @keyup.enter="fetchResults"
        />

        <div class="input-group-append">
            <button
                class="btn btn-primary"
                type="button"
                @click.prevent="fetchResults"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    role="img"
                    width="29"
                    height="29"
                    preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24"
                >
                    <path
                        fill="white"
                        d="m20.71 19.29l-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8a7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42ZM5 11a6 6 0 1 1 6 6a6 6 0 0 1-6-6Z"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        searchText: null,
    }),

    methods: {
        fetchResults() {
            axios
                .get("/api/products", {
                    params: { searchText: this.searchText },
                })
                .then(({ data }) => {
                    this.$router.replace({
                        name: "results",
                        params: {
                            searchText: this.searchText,
                            results: data.data,
                        },
                    });
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {},
};
</script>
