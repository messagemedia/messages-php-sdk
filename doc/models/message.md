
# Message

## Structure

`Message`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `callbackUrl` | `?string` | Optional | URL replies and delivery reports to this message will be pushed to | getCallbackUrl(): ?string | setCallbackUrl(?string callbackUrl): void |
| `content` | `string` | Required | Content of the message<br>**Constraints**: *Minimum Length*: `1`, *Maximum Length*: `5000` | getContent(): string | setContent(string content): void |
| `destinationNumber` | `string` | Required | Destination number of the message<br>**Constraints**: *Minimum Length*: `1`, *Maximum Length*: `15` | getDestinationNumber(): string | setDestinationNumber(string destinationNumber): void |
| `deliveryReport` | `?bool` | Optional | Request a delivery report for this message<br>**Default**: `false` | getDeliveryReport(): ?bool | setDeliveryReport(?bool deliveryReport): void |
| `format` | [`?(string[]) (FormatEnum)`](../../doc/models/format-enum.md) | Optional | Format of message, SMS, MMS or TTS (Text To Speech). | getFormat(): ?array | setFormat(?array format): void |
| `media` | `?(string[])` | Optional | - | getMedia(): ?array | setMedia(?array media): void |
| `messageExpiryTimestamp` | `?\DateTime` | Optional | Date time after which the message expires and will not be sent | getMessageExpiryTimestamp(): ?\DateTime | setMessageExpiryTimestamp(?\DateTime messageExpiryTimestamp): void |
| `metadata` | `?array` | Optional | Metadata for the message specified as a set of key value pairs, each key can be up to 100 characters long and each value can be up to 256 characters long<br><br>```<br>{<br>   "myKey": "myValue",<br>   "anotherKey": "anotherValue"<br>}<br>``` | getMetadata(): ?array | setMetadata(?array metadata): void |
| `scheduled` | `?\DateTime` | Optional | Scheduled delivery date time of the message | getScheduled(): ?\DateTime | setScheduled(?\DateTime scheduled): void |
| `sourceNumber` | `?string` | Optional | - | getSourceNumber(): ?string | setSourceNumber(?string sourceNumber): void |
| `sourceNumberType` | [`?string (SourceNumberTypeEnum)`](../../doc/models/source-number-type-enum.md) | Optional | Type of source address specified, this can be INTERNATIONAL, ALPHANUMERIC or SHORTCODE | getSourceNumberType(): ?string | setSourceNumberType(?string sourceNumberType): void |

## Example (as JSON)

```json
{
  "content": "Hello world!",
  "destination_number": "+61491570156"
}
```

