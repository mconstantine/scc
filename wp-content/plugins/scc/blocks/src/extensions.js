// TODO: add the language to code blocks to use Prism
// const { createHigherOrderComponent, withState } = wp.compose
// const { Fragment } = wp.element
// const { InspectorControls, ColorPalette } = wp.editor
// const { PanelBody, ToggleControl, BaseControl } = wp.components

// wp.hooks.addFilter(
//   'blocks.registerBlockType',
//   'moc/block-extensions/core-blocks',
//   (settings, name) => {
//     if (name === 'core/gallery') {
//       return Object.assign(settings, {
//         attributes: Object.assign(settings.attributes, {
//           isSlideshow: {
//             type: 'boolean',
//             default: false
//           }
//         })
//       })
//     }

//     if (
//       name === 'core/column' ||
//       name === 'core/heading'
//     ) {
//       return Object.assign(settings, {
//         attributes: Object.assign(settings.attributes, {
//           backgroundColor: {
//             type: 'string',
//             default: 'transparent'
//           }
//         })
//       })
//     }

//     return settings
//   }
// )

// wp.hooks.addFilter(
//   'editor.BlockEdit',
//   'moc/inspector-controls-extensions/core-blocks',

//   createHigherOrderComponent(BlockEdit => props => {
//     if (props.name === 'core/gallery') {
//       const MyToggleControl = withState({
//         isSlideshow: props.attributes.isSlideshow
//       })(({ isSlideshow, setState }) => {
//         const onChange = () => setState(state => {
//           const newState = { isSlideshow: !state.isSlideshow }
//           props.setAttributes(newState)
//           return newState
//         })

//         return (
//           <ToggleControl
//             label="Make Slideshow"
//             checked={isSlideshow}
//             onChange={onChange} />
//         )
//       })

//       return (
//         <Fragment>
//           <BlockEdit {...props} />
//           <InspectorControls>
//             <PanelBody title="Slideshow Settings">
//               <MyToggleControl />
//             </PanelBody>
//           </InspectorControls>
//         </Fragment>
//       )
//     }

//     if (
//       props.name === 'core/column' ||
//       props.name === 'core/heading'
//     ) {
//       const MyColorPalette = withState({
//         backgroundColor: props.attributes.backgroundColor
//       })(({ backgroundColor, setState }) => {
//         const onChange = backgroundColor => setState(() => {
//           const newState = { backgroundColor }
//           props.setAttributes(newState)
//           return newState
//         })

//         return (
//           <ColorPalette
//             value={backgroundColor}
//             onChange={onChange}
//           />
//         )
//       })

//       return (
//         <Fragment>
//           <BlockEdit {...props} />
//           <InspectorControls>
//             <PanelBody title="Color Settings">
//               <BaseControl label="Background Color">
//                 <MyColorPalette />
//               </BaseControl>
//             </PanelBody>
//           </InspectorControls>
//         </Fragment>
//       )
//     }

//     return <BlockEdit {...props} />
//   }, 'withInspectorControls')
// )

// wp.hooks.addFilter(
//   'blocks.getSaveElement',
//   'moc/save-extensions/cover-image-block',

//   (element, props, state) => {
//     if (props.name === 'core/cover-image') {
//       element.props.children = [element.props.children, wp.element.createElement('p', {
//         className: 'scroller'
//       }, 'Scroll')]
//     }

//     if (
//       props.name === 'core/column' ||
//       props.name === 'core/heading'
//     ) {
//       if (state.backgroundColor !== 'transparent') {
//         element.props.style = element.props.style || {}
//         element.props.className = element.props.className || ''

//         element.props.style.backgroundColor = state.backgroundColor
//         element.props.className += ' has-background'
//       }
//     }

//     if (props.name === 'core/gallery') {
//       if (state.isSlideshow) {
//         element.props.className = element.props.className || ''
//         element.props.className += ' is-slideshow'
//       }
//     }

//     return element
//   }
// )
