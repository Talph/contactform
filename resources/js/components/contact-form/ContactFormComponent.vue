
<template>
  <div class="card shadow">
    <div class="card-header">
        <h3>Contact form</h3>
    </div>

    <div class="card-body">
        <form method="POST">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div v-if="status && code == 200" class="alert alert-success">
                        {{ status }}
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="name" class="col-md-4 col-form-label ">Name</label>
                    <input id="name" type="text" class="form-control" v-model="fields.name" name="name" required
                        autocomplete="name" autofocus>

                    <div v-if="errors && errors.name" class="text-danger">
                        {{ errors.name[0] }}
                    </div>

                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="col-md-4 col-form-label ">Email address</label>
                    <input id="email" type="text" class="form-control" v-model="fields.email" name="email" required
                        autocomplete="email" autofocus>

                    <div v-if="errors && errors.email" class="text-danger">
                        {{ errors.email[0] }}
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="col-md-4 col-form-label ">Gender</label>
                    <select v-model="fields.gender" id="gender" class="form-select border-left-0" name="gender">
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Other">Other</option>
                    </select>

                    <div v-if="errors && errors.gender" class="text-danger">
                        {{ errors.gender[0] }}
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                        <textarea class="form-control" rows="5" v-model="fields.content" name="content">
                        </textarea>

                        <div v-if="errors && errors.content" class="text-danger">
                            {{ errors.content[0] }}
                        </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="submit" v-on:click="submit" :disabled="loading" class="btn col-md-12 btn-primary">
                        <span class="loading muted" v-if="loading">
                            <!-- please wait -->
                            <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="120px" height="15px"
                                viewBox="0 0 128 16" xml:space="preserve">
                                <path fill="#ffffff"
                                    d="M6.4,4.8A3.2,3.2,0,1,1,3.2,8,3.2,3.2,0,0,1,6.4,4.8Zm12.8,0A3.2,3.2,0,1,1,16,8,3.2,3.2,0,0,1,19.2,4.8ZM32,4.8A3.2,3.2,0,1,1,28.8,8,3.2,3.2,0,0,1,32,4.8Zm12.8,0A3.2,3.2,0,1,1,41.6,8,3.2,3.2,0,0,1,44.8,4.8Zm12.8,0A3.2,3.2,0,1,1,54.4,8,3.2,3.2,0,0,1,57.6,4.8Zm12.8,0A3.2,3.2,0,1,1,67.2,8,3.2,3.2,0,0,1,70.4,4.8Zm12.8,0A3.2,3.2,0,1,1,80,8,3.2,3.2,0,0,1,83.2,4.8ZM96,4.8A3.2,3.2,0,1,1,92.8,8,3.2,3.2,0,0,1,96,4.8Zm12.8,0A3.2,3.2,0,1,1,105.6,8,3.2,3.2,0,0,1,108.8,4.8Zm12.8,0A3.2,3.2,0,1,1,118.4,8,3.2,3.2,0,0,1,121.6,4.8Z" />
                                <g>
                                    <path fill="#ffffff"
                                        d="M-42.7,3.84A4.16,4.16,0,0,1-38.54,8a4.16,4.16,0,0,1-4.16,4.16A4.16,4.16,0,0,1-46.86,8,4.16,4.16,0,0,1-42.7,3.84Zm12.8-.64A4.8,4.8,0,0,1-25.1,8a4.8,4.8,0,0,1-4.8,4.8A4.8,4.8,0,0,1-34.7,8,4.8,4.8,0,0,1-29.9,3.2Zm12.8-.64A5.44,5.44,0,0,1-11.66,8a5.44,5.44,0,0,1-5.44,5.44A5.44,5.44,0,0,1-22.54,8,5.44,5.44,0,0,1-17.1,2.56Z" />
                                    <animateTransform attributeName="transform" type="translate"
                                        values="23 0;36 0;49 0;62 0;74.5 0;87.5 0;100 0;113 0;125.5 0;138.5 0;151.5 0;164.5 0;178 0"
                                        calcMode="discrete" dur="1170ms" repeatCount="indefinite" />
                                </g>
                            </svg>
                        </span>
                        <span v-else>Send Email </span>
                    </button>
                </div>
            </div>

        </form>
            <small>By clicking the "Send Email" button, you consent to the use of
            cookies and similar technologies described in our
            <a href="#">Cookie & Privacy Policy.</a></small>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
      status:[],
      code:{},
      loading: false,
    };
  },
  methods: {
    submit(e) {
      e.preventDefault();
      this.loading = true;
      this.errors = {};
      axios
        .post("/api/contacts", this.fields)
        .then((response) => {
          this.status = response.data.status;
          this.code = response.data.code;
          this.loading = false;
          this.fields = {};
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
          this.loading = false;
        });
    },
  },
};
</script>