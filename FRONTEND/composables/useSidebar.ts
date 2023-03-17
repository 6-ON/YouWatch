export const useSidebar = () => {
  const state = useState('sidebarState', () => {
    return {
      collapsed: true,
      locked: false,
    }
  })
  const isCollapsed = () => state.value.collapsed
  const isLocked = () => state.value.locked 

  const toggle = () => {
    if (!state.value.locked) {
      state.value.collapsed = !state.value.collapsed
    }
  }
  const setLocked = () => {
    state.value.collapsed = false
    state.value.locked = true
  }
  const setUnlocked = () => {
    state.value.locked = false
  }

  return { toggle, setLocked, isCollapsed,isLocked,setUnlocked }
}
