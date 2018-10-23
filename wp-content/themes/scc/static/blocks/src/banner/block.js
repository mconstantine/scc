import './style.scss'

const { RichText, MediaUpload } = wp.editor
const { registerBlockType } = wp.blocks
const { IconButton } = wp.components

registerBlockType('moc/banner', {
  title: 'Banner',
  icon: 'align-left',
  category: 'widgets',

  attributes: {
    body: {
      type: 'array',
      source: 'children',
      selector: '.body',
      placeholder: 'Body'
    },
    imageSrc: {
      type: 'string',
      source: 'attribute',
      selector: '.image',
      attribute: 'src'
    },
    imageAlt: {
      type: 'string',
      source: 'attribute',
      selector: '.image',
      attribute: 'alt'
    }
  },

  edit({ attributes, setAttributes, className }) {
    const getImageButton = open => {
      if (attributes.imageSrc) return (
        <img
          src={attributes.imageSrc}
          alt={attributes.imageAlt}
          onClick={open}
        />
      )

      return (
        <div>
          <IconButton
            icon="upload"
            label="Select an image"
            onClick={open}
          />
        </div>
      )
    }

    return (
      <div className={className}>
        <div className="image-container">
          <MediaUpload
            className="image"
            type="image"
            value={attributes.imageId}
            render={({ open }) => getImageButton(open)}
            onSelect={media => {
              const imageId = media.id
              const imageSrc = media.url
              const imageAlt = media.alt

              setAttributes({ imageId, imageSrc, imageAlt })
            }}
          />
        </div>
        <div className="body">
          <RichText
            className="body"
            value={attributes.body}
            multiline="p"
            placeholder="Body copy"
            onChange={body => setAttributes({ body })}
          />
        </div>
      </div>
    )
  },

  save({ attributes }) {
    return (
      <div>
        <div className="image-container">
          <img className="image" src={attributes.imageSrc} alt={attributes.imageAlt} />
        </div>
        <div className="body">
          {attributes.body}
        </div>
      </div>
    )
  }
})

