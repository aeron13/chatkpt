export const darkMode = () => ({
    
    isDark: Alpine.$persist(false).as('darkMode_on'),

    init() {
        if(!this.isDark) document.documentElement.classList.remove('dark')

        this.$watch('isDark', () => {
           document.documentElement.classList.toggle('dark')
        })
    }
})