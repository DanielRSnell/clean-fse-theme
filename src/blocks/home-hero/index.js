import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import './style.css';

registerBlockType('my-fse-theme/home-hero', {
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        return (
            <div {...blockProps}>
                <RichText
                    tagName="h1"
                    value={attributes.title}
                    onChange={(title) => setAttributes({ title })}
                    placeholder="Enter hero title"
                />
                <RichText
                    tagName="p"
                    value={attributes.content}
                    onChange={(content) => setAttributes({ content })}
                    placeholder="Enter hero content"
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        const blockProps = useBlockProps.save();
        return (
            <div {...blockProps}>
                <RichText.Content tagName="h1" value={attributes.title} />
                <RichText.Content tagName="p" value={attributes.content} />
            </div>
        );
    },
});
