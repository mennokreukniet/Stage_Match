class Runtime {
    constructor() {
        this.token = null;
        this.refresh();
    }

    refresh() {
        this.token = localStorage.getItem("accessToken");
        if (this.token !== null) {
            this.token = JSON.parse(atob(this.token.split(".")[1]));
        }

        return this.token;
    }

    clear() {
        this.token = null;
        return this.token;
    }
};

export const runtime = new Runtime();