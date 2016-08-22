# swissplaces
Deliver zip for cantons, regions and districts

## Cantons

### Get postalcodes of all cantons
- `Canton::getPostalcodes()`

### Get postalcodes of desired canton(s)

- `Canton::getPostalcodes('TG,SG,AG')`

or

- `Canton::getPostalcodes(array('TG', 'SG', 'AG'))`


## Districts

### Get postalcodes of all districts
- `District::getPostalcodes()`

### Get postalcodes of all districts from the given canton
- District::getPostalcodes('TG')

or

- District::getPostalcodes([ 'TG' ])

or

- District::getPostalcodes([ 'TG' => [ ] ])

### Get postalcodes of all districts from the given cantons
- District::getPostalcodes('TG;LU')

or

- District::getPostalcodes([ 'TG', 'LU' ])

or

- District::getPostalcodes([ 'TG' => [ ], 'LU' => [ ] ])


### Get postalcodes of the given district
- District::getPostalcodes('TG:Arbon')

or

- District::getPostalcodes([ 'TG' => [ 'Arbon' ] ])


### Get postalcodes of the given districts
- District::getPostalcodes('TG:Arbon,Kreuzlingen')

or

- District::getPostalcodes([ 'TG' => [ 'Arbon' ], 'AG' => [ 'Aarau', 'Brugg' ] ])

## Regions
`// coming soon`