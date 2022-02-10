<template>
    <div class="row justify-content-center my-4">
        <div class="mb-4 col-md-6">
            <form>
                <div class="input-group border rounded-pill p-1">
                    <input
                        v-model="searchQuery"
                        placeholder="Search by name"
                        class="form-control rounded-pill bg-none border-0"
                    />
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th class="col-2" scope="col-4">
                                <span class="dropdown pl-3">
                                    <span
                                        class="checkbox"
                                        id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        Gender
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-chevron-down ml-5"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                                            />
                                        </svg>
                                    </span>
                                    <ul
                                        class="dropdown-menu p-1"
                                        aria-labelledby="dropdownMenuButton1"
                                    >
                                        <div
                                            class="form-group"
                                            v-for="check in gender"
                                            v-bind:key="check.id"
                                        >
                                            <label
                                                :for="check.id"
                                                class="form-check-label"
                                            >
                                                <input
                                                    type="checkbox"
                                                    v-model="checkedQuery"
                                                    v-bind:value="check.name"
                                                    :id="check.id"
                                                    class="form-check-input"
                                                />
                                                {{ check.name }}</label
                                            >
                                        </div>
                                    </ul>
                                </span>
                            </th>
                            <th scope="col">Content</th>
                        </tr>
                    </thead>
                    <tbody v-for="result in dataQuery" v-bind:key="result.id">
                        <tr v-if="results.length === 0">
                            <td class="lead text-center">No data found.</td>
                        </tr>
                        <tr>
                            <td>
                                {{ result.name }}
                            </td>
                            <td>
                                {{ result.email }}
                            </td>
                            <td>
                                {{ result.gender }}
                            </td>
                            <td>
                                {{ result.content }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchQuery: null,
            checkedQuery: [],
            results: [],
            gender: [{ name: "male" }, { name: "female" }, { name: "other" }],
        };
    },
    mounted() {
        this.loadContacts();
    },
    computed: {
        dataQuery() {
            if (this.searchQuery) {
                return this.results.filter((item) => {
                    return this.searchQuery
                        .toLowerCase()
                        .split(" ")
                        .every((v) => item.name.toLowerCase().includes(v));
                });
            } 
            
            if (this.checkedQuery.length > 0) {
                return this.results.filter((item) => {
                    return -1 !== _.indexOf(this.checkedQuery, item.gender);
                });
            } else {
                return this.results;
            }
        },
    },
    methods: {
        loadContacts() {
            axios
                .get("/api/contacts")
                .then((response) => {
                    this.results = response.data.data;
                })
                .catch((error) => (this.results = []));
        },
    },
};
</script>