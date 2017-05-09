# swift-from-iban
Get Bank Swift Code from Iban

## Example

```
public function testGetCode()
{
    $swift = new SwiftCode();

    $code = $swift->getCode("PL69102042870000000000000000");

    $this->assertSame("BPKOPLPWXXX", $code);
}
```
