export const useSidebar = () => {
  const state = useState('sidebarState', () => {
    return {
      collapsed: true,
      locked: false,
    }
  })
  const isCollapsed = () => state.value.collapsed
  const isLocked = () => state.value.locked

  const hide = () => {
    if (!state.value.locked) {
      state.value.collapsed = true
    }
  }
  const show = () => {
    state.value.collapsed = false
  }
  const setLocked = () => {
    state.value.collapsed = false
    state.value.locked = true
  }
  const setUnlocked = () => {
    state.value.collapsed = true
    state.value.locked = false
  }

  return { state, hide, show, setLocked, isCollapsed, isLocked, setUnlocked }
}
