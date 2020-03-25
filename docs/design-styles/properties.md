# CSS Property Glossary

## How this works
Go leverages CSS custom properties – also referred to as CSS variables — to make it easier to extend the design of the theme. The CSS properties Go uses are configured via the following format: `--go--{target}--{propertyName}`, where `{target}` is the element we're wanting to style, while `{propertyName}` is the specific CSS property to modify.

### Example:
To target the text alignment of each caption, you'd use `--go--caption--text-align`, setting the value to either `left`, `right`, or `center`: 

```
:root {
	--go--caption--text-align: center;
}
```


## CSS Properties
Here are properties that may be leveraged within design style stylesheets:

### Structure
| CSS Property  | Description |
| ------------- | ------------- |
| --go--max-width  | Standard page content width |
| --go--max-width--alignwide | Wide alignment content width |
| --go--spacing--header | Site header XY spacing |
| --go--spacing--horizontal | Horizontal viewport spacing |
| --go--spacing--paragraph | Paragraph spacing |
| --go--viewport-basis | Global site spacing basis |


### Typography
| CSS Property  | Description |
| ------------- | ------------- |
| --go--color--text ||
| --go--font-family ||
| --go--font-size ||
| --go--font-size--small ||
| --go--line-height ||
| --go--type-ratio ||


### Formatting

#### Hyperlinks
| CSS Property  | Description |
| ------------- | ------------- |
| --go--hyperlink--color--text ||
| --go--hyperlink-interactive--color--text ||

#### Captions
| CSS Property  | Description |
| ------------- | ------------- |
| --go-caption--color--text ||
| --go-caption--font-size ||
| --go-caption--text-align ||
| --go-caption--text-align--rtl ||


### Forms

#### Labels
| CSS Property  | Description |
| ------------- | ------------- |
| --go-label--font-size ||
| --go-label--font-weight ||
| --go-label--letter-spacing ||
| --go-label--margin-bottom | Space between label and the input below it |

#### Inputs
| CSS Property  | Description |
| ------------- | ------------- |
| --go-input--border ||
| --go-input--color--text ||
| --go-input--margin-bottom ||
| --go-input--padding--x ||
| --go-input--padding--y ||

#### Buttons
| CSS Property  | Description |
| ------------- | ------------- |
| --go-button--border-radius ||
| --go-button--font-size ||
| --go-button--font-weight ||
| --go-button--letter-spacing ||
| --go-button--padding--x ||
| --go-button--padding--y ||
| --go-button--text-transform ||
| --go-button-interactive--color--background ||


### Elements

#### Site Navigation
| CSS Property  | Description |
| ------------- | ------------- |
| --go-navigation--color--text ||
| --go-navigation--font-family ||
| --go-navigation--font-size ||
| --go-navigation-mobile--font-size ||
| --go-navigation--font-weight ||
| --go-navigation--text-transform ||
| --go-navigation--letter-spacing ||









