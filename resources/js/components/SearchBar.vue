<template>
    <div
        class="mr-0 mr-lg-3 order-2 order-lg-1 w-100"
        style="position: relative"
    >
        <div class="input-group home-search-input">
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
        <div
            class="search-suggestion"
            v-if="results.length > 0 && this.searchText != ''"
        >
            <ul>
                <li
                    v-for="result in results"
                    :key="result.id"
                    @click.prevent="resetResults()"
                >
                    <router-link
                        :to="{
                            name: 'products/product',
                            params: {
                                productId: result.id,
                            },
                        }"
                    >
                        {{ result.title }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import _ from "lodash";

export default {
    data: () => ({
        searchText: null,
        results: [],
    }),

    watch: {
        searchText: _.debounce(function (after, before) {
            if (this.searchText != "") {
                Fire.$emit("reloadRecords");
            }
        }, 500),
    },

    methods: {
        resetResults() {
            this.results = [];
        },

        loadResults() {
            axios
                .get("/api/search/" + this.searchText)
                .then((response) => {
                    this.results = response.data.products;
                })
                .catch((error) => console.log(error));
        },

        fetchResults() {
            axios
                .get("/api/search", {
                    params: { searchText: this.searchText },
                })
                .then((response) => {
                    this.resetResults();
                    this.$router.replace({
                        name: "results",
                        query: { t: Date.now() },
                        params: {
                            searchText: this.searchText,
                            resultsProduct: response.data.products,
                            resultsOccasion: response.data.occasions,
                            resultsRecipient: response.data.recipients,
                            resultsCategory: response.data.categories,
                            resultsShop: response.data.shops,
                        },
                    });
                })
                .catch((error) => console.log(error));
        },
    },

    mounted() {
        Fire.$on("reloadRecords", () => {
            this.loadResults();
        });
    },
};
</script>
