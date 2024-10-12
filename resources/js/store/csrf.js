export default {
    
    token: null,

    init() {
        this.token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
}