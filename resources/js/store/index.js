import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        //data
        products: [],
        cart: [], //{product id, product quantity}
    },

    getters: {
        //computed properties
        availableProducts(state, getters) {
            return state.products.filter((product) => product.category_id == 1);
        },

        cartProducts(state) {
            let sum = 0;
            return state.cart.map((cartItem) => {
                const product = state.products.find(
                    (product) => product.id === cartItem.id
                );
                return {
                    id: product.id,
                    title: product.title,
                    price: product.base_price,
                    quantity: cartItem.quantity,
                };
            });
        },

        cartTotal(state) {
            let sum = 0;
            state.cart.map((cartItem) => {
                const product = state.products.find(
                    (product) => product.id === cartItem.id
                );
                sum += product.base_price * cartItem.quantity;
            });
            return sum.toFixed(2);
        },
    },

    actions: {
        //methods
        fetchProducts() {
            //make the call
            //run setProducts mutation
        },

        addProductToCart(context, product) {
            const cartItem = context.state.cart.find(
                (item) => item.id === product.id
            );
            if (!cartItem) {
                context.commit("pushProductToCart", product);
            } else {
                context.commit("incrementItemQuantity", cartItem);
            }
        },

        removeProductFromCart(context, product) {
            context.commit("deleteProductFromCart", product);
        },

        decreaseProductQuantity(context, product) {
            const cartItem = context.state.cart.find(
                (item) => item.id === product.id
            );
            if (cartItem.quantity === 1) {
                context.commit("deleteProductFromCart", product);
            } else {
                context.commit("decrementItemQuantity", cartItem);
            }
        },
    },

    mutations: {
        //alter state
        setProducts(state, products) {
            //update products
            state.products = products;
        },

        pushProductToCart(state, product) {
            state.cart.push({
                id: product.id,
                title: product.title,
                price: product.base_price,
                quantity: 1,
            });
        },

        incrementItemQuantity(state, cartItem) {
            cartItem.quantity++;
        },

        decrementItemQuantity(state, cartItem) {
            cartItem.quantity--;
        },

        deleteProductFromCart(state, product) {
            let index = state.cart.findIndex((c) => c.id === product.id);

            if (index > -1) {
                state.cart.splice(index, 1);
            }
        },

        saveCart(state) {
            window.localStorage.setItem("cart", JSON.stringify(state.cart));
            window.localStorage.setItem("cartCount", state.cart.length);
        },
    },
});
