<script type="text/javascript">
    window.Spotlight = (config) => {
        return {
            commands: @js($commands),
            selectedCommandIndex: -1,
            isOpen: false,
            init() {
                this.$watch('isOpen', value => {
                    if (value === false) {
                        setTimeout(() => {
                            this.selectedCommandIndex = -1;
                        }, 300);
                    }
                });
            },
            toggleOpen() {
                this.isOpen = !this.isOpen

                if (!this.isOpen) {
                    return;
                }

                setTimeout(() => {
                    this.$refs.input.focus()
                }, 100)
            },
            goToPrevious() {
                this.selectedCommandIndex = Math.max(0, this.selectedCommandIndex - 1)

                this.$nextTick(() => {
                    this.toggleStateClasses();
                })
            },
            goToNext() {
                if (this.selectedCommandIndex + 1 > this.commands.length) {
                    this.selectedCommandIndex = 0
                } else {
                    this.selectedCommandIndex = Math.min(this.commands.length - 1, this.selectedCommandIndex + 1)
                }

                this.$nextTick(() => {
                    this.toggleStateClasses();
                })
            },
            executeCommand(id) {
                this.$wire.executeCommand(this.commands.find((command) => {
                    return command.id === (id ? id : this.commands[this.selectedCommandIndex].id);
                }).id);
            },
            toggleStateClasses() {
                for (const child of this.$refs.results.children) {
                    child.classList.remove('bg-gray-100')
                }

                this.$refs.results.children[this.selectedCommandIndex].classList.add('bg-gray-100')

                this.$refs.results.children[this.selectedCommandIndex].scrollIntoView({
                    block: 'nearest',
                })
            }
        };
    };
</script>
