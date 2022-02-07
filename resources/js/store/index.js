import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        //data
        cart: [], //{product id, product quantity}
        currentCart: [], //cart being currently processed
        total: "",
    },

    getters: {
        cartProducts(state) {
            return state.cart.map((cartItem) => {
                return {
                    id: cartItem.id,
                    title: cartItem.title,
                    price: cartItem.price,
                    user_id: cartItem.user_id,
                    shop: cartItem.shop,
                    category: cartItem.category,
                    quantity: cartItem.quantity,
                };
            });
        },

        cartTotal(state) {
            let sum = 0;
            state.cart.map((cartItem) => {
                sum += cartItem.price * cartItem.quantity;
            });

            return sum.toFixed(2);
        },

        shopCartTotal(state) {
            return state.total;
        },

        currentCartProducts(state) {
            return state.currentCart.map((cartItem) => {
                return {
                    id: cartItem.id,
                    title: cartItem.title,
                    price: cartItem.price,
                    shop: cartItem.shop,
                    quantity: cartItem.quantity,
                };
            });
        },

        cartProductsByShop(state) {
            return _.groupBy(state.cart, (cartItem) => cartItem.user_id);
        },
    },

    actions: {
        //methods
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

        saveShopCartTotal(context, total) {
            context.commit("storeShopCartTotal", total);
        },

        addProductToCurrentCart(context, shop) {
            //context.commit("pushProductToCurrentCart", product);
            shop.map((product) => {
                context.commit("pushProductToCurrentCart", product);
            });
        },
    },

    mutations: {
        //alter state
        pushProductToCart(state, product) {
            state.cart.push({
                id: product.id,
                title: product.title,
                price: product.base_price,
                user_id: product.user_id,
                shop: product.user.shop.name,
                category: product.category.name,
                quantity: 1,
            });
        },

        pushProductToCurrentCart(state, product) {
            state.currentCart.push({
                id: product.id,
                title: product.title,
                price: product.base_price,
                shop: product.shop,
                quantity: product.quantity,
            });
        },

        incrementItemQuantity(state, cartItem) {
            cartItem.quantity++;
        },

        decrementItemQuantity(state, cartItem) {
            cartItem.quantity--;
        },

        storeShopCartTotal(state, total) {
            state.total = total;
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
