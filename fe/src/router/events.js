import API from "../store/base/index";
export default {
    watch: {
        $route: "setHeaders",
    },
    methods: {
        async setHeaders() {
            const bearer_token = localStorage.getItem("auth") || "";
            API.defaults.headers.common["Authorization"] = `Bearer ${bearer_token}`;

            API.get("/auth/user/permission").then((response) => {
                this.$ability.update([{ subject: "all", action: response.data }]);
            });
        },
    },
};