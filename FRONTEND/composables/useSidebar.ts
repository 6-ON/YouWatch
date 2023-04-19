export const useSidebar = () => {
  const state = useState('sidebarState', () => ({
    collapsed: true,
    locked: false,
  }))
  const collapsed = () => state.value.collapsed
  const locked = () => state.value.locked

  const toggle = () => {
    state.value.collapsed = !state.value.collapsed 
    console.log(collapsed());
    
  }
  const hide = () => {
    state.value.collapsed = true
  }
  const show = () => {
    state.value.collapsed = false
  }
  const lock = () => {
    state.value.locked = true
  }
  const unlock = () => {
    state.value.locked = false
  }

  return {
    state,
    hide,
    show,
    toggle,
    lock,
    collapsed,
    locked,
    unlock
  }
}
