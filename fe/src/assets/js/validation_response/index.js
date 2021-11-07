// =VALIDATION AND RESPONSE
export default {
    data() {
        return {
            isLoading: false,
            initialLoading: false,
        };
    },
    methods: {
        formatCurrency(data) {
            var formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'PHP',
            });
            return formatter.format(data);
        },
        async checkStatus(data, status, type, dispatch, config) {
            if (status == 422) {
                console.log(status);
                this.UnprocEntity(data);
            } else if (status == 200) {
                if (type != 'update') {
                    await this.$store.dispatch(dispatch, { page: 1, sort: this.sort });
                }
                this.successResponse(data);
            } else {
                this.errResponse(data);
            }
        },
        async interviewCheckStatus(data, status, type, dispatch) {
            if (status == 422) {
                this.UnprocEntity(data);
            } else if (status == 200) {
                if (type != 'update') {
                    await this.$store.dispatch(dispatch, { page: 1, sort: this.sort });
                }
                this.successResponse2(data);
            } else {
                this.errResponse(data);
            }
        },
        async interviewApproveCheckStatus(data, status, type, dispatch) {
            if (status == 422) {
                this.UnprocEntity(data);
            } else if (status == 200) {
                if (type != 'update') {
                    await this.$store.dispatch(dispatch, { page: 1, sort: this.sort });
                }
                this.successResponse3(data);
            } else {
                this.errResponse(data);
            }
        },
        async fsApproveCheckStatus(data, status, type, dispatch) {
            if (status == 422) {
                this.UnprocEntity(data);
            } else if (status == 200) {
                if (type != 'update') {
                    await this.$store.dispatch(dispatch, { page: 1, sort: this.sort });
                }
                this.successResponse5(data);
            } else {
                this.errResponse(data);
            }
        },
        async failedApplicantCheckStatus(data, status, type, dispatch) {
            if (status == 422) {
                this.UnprocEntity(data);
            } else if (status == 200) {
                if (type != 'update') {
                    await this.$store.dispatch(dispatch, { page: 1, sort: this.sort });
                }
                this.successResponse4(data);
            } else {
                this.errResponse(data);
            }
        },
        UnprocEntity(data) {
            for (const key of Object.keys(data)) {
                this.$toast.error(data[key][0]);
            }
            this.isLoading = false;
        },
        successResponse(data) {
            this.closeModal();
            console.log(data);
            this.isLoading = false;
            return this.$toast.success(data.msg);
        },
        successResponse2(data) {
            this.$router.push('/home/human-resources/applicants/interview');
            return this.$toast.success(data.msg);
        },
        successResponse3(data) {
            this.$router.push('/home/human-resources/applicants/finalscreening');
            return this.$toast.success(data.msg);
        },
        successResponse4(data) {
            this.$router.push('/home/human-resources/applicants/allapplicants');
            return this.$toast.success(data.msg);
        },
        successResponse5(data) {
            this.$router.push('/home/human-resources/applicants/onboarding');
            return this.$toast.success(data.msg);
        },
        errResponse(data) {
            this.closeModal();
            this.isLoading = false;
            return this.$toast.error(data.msg);
        },
    },
};