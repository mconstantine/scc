import './style.scss'

const { RichText, MediaUpload, PlainText } = wp.editor
const { registerBlockType } = wp.blocks
const { IconButton } = wp.components

registerBlockType('moc/show-off', {
  title: 'Show off',
  icon: 'align-left',
  category: 'widgets',

  attributes: {
    body: {
      type: 'array',
      source: 'children',
      selector: '.body',
      placeholder: 'Body'
    },
    data: {
      type: 'array',
      source: 'query',
      selector: '.data-block',
      default: [],
      query: {
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
        },
        headline: {
          type: 'array',
          selector: '.heading',
          source: 'children',
          placeholder: 'Headline'
        },
        description: {
          type: 'array',
          selector: '.description',
          source: 'children',
          placeholder: 'Description'
        }
      }
    }
  },

  edit({ attributes, setAttributes, className }) {
    const getImageButton = (index, open) => {
      if (attributes.data[index] && attributes.data[index].imageSrc) return (
        <img
          src={attributes.data[index].imageSrc}
          alt={attributes.data[index].imageAlt}
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

    const addDataBlock = () => {
      setAttributes({ data: attributes.data.concat([{}]) })
    }

    const removeDataBlock = index => {
      setAttributes({
        data: attributes.data.slice(0, index).concat(attributes.data.slice(index + 1))
      })
    }

    const dataEls = attributes.data.map((dataBlock, index) => (
      <div className="data-block" key={index}>
        <div className="data-block-image">
          <MediaUpload
            className="image"
            type="image"
            value={dataBlock.imageId}
            render={({ open }) => getImageButton(index, open)}
            onSelect={media => {
              const data = [...attributes.data]
              data[index].imageId = media.id
              data[index].imageSrc = media.url
              data[index].imageAlt = media.alt
              setAttributes({ data })
            }}
          />
        </div>
        <div className="data-block-description">
          <PlainText
            value={dataBlock.headline}
            placeholder="Headline"
            className="heading"
            onChange={content => {
              const data = [...attributes.data]
              data[index].headline = content
              setAttributes({ data })
            }}
          />
          <RichText
            value={dataBlock.description}
            placeholder="Description"
            className="description"
            onChange={content => {
              const data = [...attributes.data]
              data[index].description = content
              setAttributes({ data })
            }}
          />
        </div>
        <IconButton
          icon="minus"
          label="Remove Data Block"
          onClick={() => removeDataBlock(index)}
        />
      </div>
    ))

    return (
      <div className={className}>
        <div className="body">
          <RichText
            className="body"
            value={attributes.body}
            multiline="p"
            placeholder="Body copy"
            onChange={body => setAttributes({ body })}
          />
        </div>
        <div className="data">
          {dataEls}
          <div>
            <IconButton
              icon="plus"
              label="Add Data Block"
              onClick={() => addDataBlock()}
            />
          </div>
        </div>
      </div>
    )
  },

  save({ attributes }) {
    const dataEls = attributes.data.map((dataBlock, index) => (
      <div className="data-block" key={index}>
        <div className="data-block-image">
          <img
            className="image"
            src={dataBlock.imageSrc}
            alt={dataBlock.imageAlt}
          />
        </div>
        <div className="data-block-description">
          <h3 className="heading">{dataBlock.headline}</h3>
          <p className="description">{dataBlock.description}</p>
        </div>
      </div>
    ))

    return (
      <div>
        <div className="body">
          {attributes.body}
        </div>
        <div className="data">
          {dataEls}
        </div>
      </div>
    )
  }
})

